<?php

namespace App\Repositories;

use App\Http\Requests\CreateUpdateParagraphRequest;
use App\Models\Paragraph;
use App\Models\Post;

class ParagraphRepository implements ParagraphRepositoryInterface
{
    public function createParagraph(CreateUpdateParagraphRequest $request, Post $post): Paragraph
    {
        $paragraph = new Paragraph();
        $paragraph->post_id = $post->id;
        $paragraph->content = $request->content;
        $paragraph->save();

        return $paragraph;
    }

    public function updateParagraph(CreateUpdateParagraphRequest $request, Paragraph $paragraph): Paragraph
    {
        $paragraph->content = $request->content;
        $paragraph->save();

        return $paragraph;
    }

    public function getParagraphsForPost(Post $post): iterable
    {
        return $post->paragraphs()->get();
    }
}
