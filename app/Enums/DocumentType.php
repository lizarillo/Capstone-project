<?php

namespace App\Enums;

enum DocumentType: string
{
    case ReportCard = 'report_card';
    case BirthCertificate = 'birth_certificate';
    case RecommendationLetter = 'recommendation_letter';
    case Transcript = 'transcript';
    case Certificate = 'certificate';
    
    public function label(): string
    {
        return match($this) {
            self::ReportCard => 'Report Card',
            self::BirthCertificate => 'Birth Certificate',
            self::RecommendationLetter => 'Recommendation Letter',
            self::Transcript => 'Transcript',
            self::Certificate => 'Certificate',
        };
    }
}