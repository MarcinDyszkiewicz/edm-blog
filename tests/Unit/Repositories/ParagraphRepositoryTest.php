<?php

namespace Tests\Unit\Repositories;

use App\Http\Requests\CreateUpdateParagraphRequest;
use App\Models\Paragraph;
use App\Models\Post;
use App\Services\ParagraphServiceInterface;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class ParagraphRepositoryTest extends TestCase
{
    private ParagraphServiceInterface $paragraphRepository;
    private Post $post;
    private CreateUpdateParagraphRequest $request;
    private Paragraph $paragraph;

    protected function setUp(): void
    {
        parent::setUp();
        $this->paragraphRepository = $this->createMock(ParagraphServiceInterface::class);
        $this->paragraph = $this->createMock(Paragraph::class);
        $this->post = $this->createMock(Post::class);
        $this->request = $this->createMock(CreateUpdateParagraphRequest::class);
    }

    public function testCreateParagraphProperly()
    {
        $this->paragraphRepository
            ->method('createParagraph')
            ->with($this->request, $this->post)
            ->willReturn($this->paragraph);

        $paragraph = $this->paragraphRepository->createParagraph($this->request, $this->post);

        $this->assertInstanceOf(Paragraph::class, $paragraph);
    }

    public function testUpdateParagraphProperly()
    {
        $this->paragraphRepository
            ->method('updateParagraph')
            ->with($this->request, $this->paragraph)
            ->willReturn($this->paragraph);

        $paragraph = $this->paragraphRepository->updateParagraph($this->request, $this->paragraph);

        $this->assertInstanceOf(Paragraph::class, $paragraph);
    }

    public function testGetParagraphsForPostProperly()
    {
        $this->paragraphRepository
            ->method('getParagraphsForPost')
            ->with($this->post)
            ->willReturn(Collection::make($this->paragraph));

        $paragraphs = $this->paragraphRepository->getParagraphsForPost($this->post);

        $this->assertInstanceOf(Collection::class, $paragraphs);
    }
}
