<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PostsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $posts = Post::all();
        return $posts;
    }

    public function map($post): array
    {
        return[
            $post->id,
            $post->title,
            $post->description,
            $post->image,
        ];
    }

    public function headings(): array
    {
        return[
            'ID',
            'Title',
            'Description',
            'Image'
        ];
    }
}
