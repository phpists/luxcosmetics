<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class FeedbackMessageFile extends Model
{

    protected $fillable = [
        'disk',
        'name',
        'path',
    ];

    const FILES_PATH = '/feedback-message-files/';


    protected static function booted (): void
    {

        self::deleted(function(self $model) {
            try {
                \Storage::disk($model->disk)->delete($model->path);
            } catch (\Exception $exception) {
                \Log::error($exception->getMessage());
            }
        });

    }


    public function getPreviewUrl(): string
    {
        $googleFileId = Storage::disk('google')->getAdapter()->getMetadata($this->path)?->extraMetadata()['id'] ?? null;
        if ($googleFileId)
            return "https://drive.google.com/file/d/$googleFileId/preview";

        return '#';
    }

}
