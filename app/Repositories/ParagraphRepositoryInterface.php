<?php

namespace App\Repositories;

use App\Http\Requests\CreateUpdateParagraphRequest;
use App\Models\Paragraph;
use App\Models\Post;

interface ParagraphRepositoryInterface
{
    public function createParagraph(CreateUpdateParagraphRequest $request, Post $post): Paragraph;

    public function updateParagraph(CreateUpdateParagraphRequest $request, Paragraph $paragraph): Paragraph;

    public function getParagraphsForPost(Post $post): iterable;
}
