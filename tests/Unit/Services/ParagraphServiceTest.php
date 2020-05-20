<?php

namespace Tests\Unit\Services;

use App\Http\Requests\CreateUpdateParagraphRequest;
use App\Models\Paragraph;
use App\Models\Post;
use App\Services\ParagraphServiceInterface;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class ParagraphServiceTest extends TestCase
{
    private ParagraphServiceInterface $paragraphService;
    private Paragraph $paragraph;
    private Post $post;
    private CreateUpdateParagraphRequest $request;

    protected function setUp(): void
    {
        parent::setUp();
        $this->paragraphService = $this->createMock(ParagraphServiceInterface::class);
        $this->paragraph = $this->createMock(Paragraph::class);
        $this->post = $this->createMock(Post::class);
        $this->request = $this->createMock(CreateUpdateParagraphRequest::class);
    }

    public function testCreateParagraphProperly()
    {
        $this->paragraphService
            ->method('createParagraph')
            ->with($this->request, $this->post)
            ->willReturn($this->paragraph);

        $paragraph = $this->paragraphService->createParagraph($this->request, $this->post);

        $this->assertInstanceOf(Paragraph::class, $paragraph);
    }

    public function testUpdateParagraphProperly()
    {
        $this->paragraphService
            ->method('updateParagraph')
            ->with($this->request, $this->paragraph)
            ->willReturn($this->paragraph);

        $paragraph = $this->paragraphService->updateParagraph($this->request, $this->paragraph);

        $this->assertInstanceOf(Paragraph::class, $paragraph);
    }

    public function testGetParagraphsForPostProperly()
    {
        $this->paragraphService
            ->method('getParagraphsForPost')
            ->with($this->post)
            ->willReturn(Collection::make($this->paragraph));

        $paragraphs = $this->paragraphService->getParagraphsForPost($this->post);

        $this->assertInstanceOf(Collection::class, $paragraphs);
    }
}
