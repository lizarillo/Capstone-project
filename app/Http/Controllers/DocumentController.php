<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Enums\DocumentStatus;

class DocumentController extends Controller
{

    public function updateStatus(Request $request, Document $document)
    {
        // Validate the status input using the enum values
        $request->validate([
            'status' => 'required|in:' . implode(',', \App\Enums\DocumentStatus::values()),
        ]);
    
        // Update the document's status using the validated status value
        $document->update([
            'status' => \App\Enums\DocumentStatus::from($request->input('status'))->value,
        ]);
    
        return back()->with('success', 'Document status updated successfully.');
    }
    
    // Index Method - Display list of documents with filters, sorting, and pagination
    public function index(Request $request)
    {
        $query = Document::query();

        // Add filters
        $this->applyFilters($request, $query);

        // Sorting
        $this->applySorting($request, $query);

        // Pagination with preserved query parameters
        $documents = $query->paginate(10)->appends($request->query());

        return view('documents.allDocument', compact('documents'));
    }

    // Approve Document Method
    public function approve(Document $document)
    {
        // Check if the document is already approved
        if ($document->status === DocumentStatus::Approved) {
            return back()->with('warning', 'Document is already approved!');
        }

        // Update the document status to 'approved'
        $document->update(['status' => DocumentStatus::Approved]);
        return redirect()->route('documents.index')->with('success', 'Document approved!');
    }

    // Store Method - Save new document
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:documents',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_type' => 'required|in:report_card,birth_certificate,recommendation_letter',
            'program' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'document' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('documents', 'public');
            $validated['document_path'] = $path;
        }

        Document::create($validated);

        return redirect()->route('documents.index')
            ->with('success', 'Document created successfully');
    }

    // Export to PDF Method
    public function exportPdf(Request $request)
    {
        $query = Document::query();
        $this->applyFilters($request, $query);
        $documents = $query->get();

        $pdf = Pdf::loadView('documents.pdf', compact('documents'));
        return $pdf->download('documents-' . now()->format('YmdHis') . '.pdf');
    }

    // Show Method - Display a single document's details
    public function show(Document $document)
    {
        return view('documents.show', compact('document'));
    }

    // Edit Method - Display the form for editing a document
    public function edit(Document $document)
    {
        return view('documents.edit', compact('document'));
    }

    // Update Method - Update an existing document
    public function update(Request $request, Document $document)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:documents,student_id,' . $document->id,
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'document_type' => 'required|in:report_card,birth_certificate,recommendation_letter',
            'program' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'document' => 'sometimes|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Handle file update
        if ($request->hasFile('document')) {
            // Delete old file
            Storage::disk('public')->delete($document->document_path);

            $path = $request->file('document')->store('documents', 'public');
            $validated['document_path'] = $path;
        }

        $document->update($validated);

        return redirect()->route('documents.index')
            ->with('success', 'Document updated successfully');
    }

    // Destroy Method - Delete an existing document
    public function destroy(Document $document)
    {
        try {
            // Delete associated file
            Storage::disk('public')->delete($document->document_path);
            $document->delete();
            return redirect()->route('documents.index')
                ->with('success', 'Document deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting document: ' . $e->getMessage());
        }
    }

    // Filters and sorting logic
    private function applyFilters(Request $request, $query)
    {
        $filters = [
            'student_id',
            'document_id' => 'id',
            'first_name',
            'last_name',
            'program',
            'institution',
            'document_type'
        ];

        foreach ($filters as $param => $column) {
            if (is_numeric($param)) {
                $param = $column;
            }

            if ($request->filled($param)) {
                $query->where($column, 'like', '%' . $request->input($param) . '%');
            }
        }
    }

    // Sorting logic
    private function applySorting(Request $request, $query)
    {
        if ($request->has('sort_by')) {
            $sortableColumns = [
                'student_id',
                'first_name',
                'last_name',
                'program',
                'institution',
                'document_type',
                'created_at'
            ];

            $sortBy = $request->input('sort_by');
            $direction = $request->input('sort_direction', 'asc');

            if (in_array($sortBy, $sortableColumns)) {
                $query->orderBy($sortBy, $direction);
            }
        }
    }
}
