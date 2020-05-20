<?php

namespace App\Services;

use App\Http\Requests\CreateUpdateParagraphRequest;
use App\Models\Paragraph;
use App\Models\Post;
use App\Repositories\ParagraphRepositoryInterface;

class ParagraphService implements ParagraphServiceInterface
{

    private ParagraphRepositoryInterface $paragraphRepository;

    public function __construct(ParagraphRepositoryInterface $paragraphRepository)
    {
        $this->paragraphRepository = $paragraphRepository;
    }

    public function createParagraph(CreateUpdateParagraphRequest $request, Post $post): Paragraph
    {
        return $this->paragraphRepository->createParagraph($request, $post);
    }

    public function updateParagraph(CreateUpdateParagraphRequest $request, Paragraph $paragraph): Paragraph
    {
        return $this->paragraphRepository->updateParagraph($request, $paragraph);
    }

    public function getParagraphsForPost(Post $post): iterable
    {
        return $this->paragraphRepository->getParagraphsForPost($post);
    }
}
