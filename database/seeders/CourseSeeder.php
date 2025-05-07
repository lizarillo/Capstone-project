use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'name' => 'Computer Science',
            'code' => 'CS101',
            'description' => 'Introduction to computer science.'
        ]);

        Course::create([
            'name' => 'Mathematics',
            'code' => 'MATH101',
            'description' => 'Introduction to basic mathematical concepts.'
        ]);
    }
}
