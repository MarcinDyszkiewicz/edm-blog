<?php

namespace App\Services;

use App\Http\Requests\CreateUpdateParagraphRequest;
use App\Models\Paragraph;
use App\Models\Post;

interface ParagraphServiceInterface
{
    public function createParagraph(CreateUpdateParagraphRequest $request, Post $post): Paragraph;

    public function updateParagraph(CreateUpdateParagraphRequest $request, Paragraph $paragraph): Paragraph;

    /**
     * @param Post $post
     * @return Paragraph[]
     */
    public function getParagraphsForPost(Post $post): iterable;
}
