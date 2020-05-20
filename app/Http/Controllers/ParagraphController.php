<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUpdateParagraphRequest;
use App\Http\Responses\ExceptionResponse;
use App\Http\Responses\MyJsonResponse;
use App\Models\Paragraph;
use App\Models\Post;
use App\Services\ParagraphServiceInterface;
use Illuminate\Http\Response;

class ParagraphController extends Controller
{

    private ParagraphServiceInterface $paragraphService;

    public function __construct(ParagraphServiceInterface $paragraphService)
    {
        $this->paragraphService = $paragraphService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Post $post
     * @return ExceptionResponse|MyJsonResponse
     */
    public function index(Post $post)
    {
        try {
            $paragraphs = $this->paragraphService->getParagraphsForPost($post);

            return new MyJsonResponse($paragraphs);
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUpdateParagraphRequest $request
     * @param Post $post
     * @return ExceptionResponse|MyJsonResponse
     */
    public function store(CreateUpdateParagraphRequest $request, Post $post)
    {
        try {
            $paragraph = $this->paragraphService->createParagraph($request->validated(), $post);

            return new MyJsonResponse($paragraph, Response::HTTP_CREATED);
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Paragraph $paragraph
     * @return \Illuminate\Http\Response
     */
    public function show(Paragraph $paragraph)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateUpdateParagraphRequest $request
     * @param Post $post
     * @param Paragraph $paragraph
     * @return ExceptionResponse|MyJsonResponse
     */
    public function update(CreateUpdateParagraphRequest $request, Post $post, Paragraph $paragraph)
    {
        try {
            $paragraph = $this->paragraphService->updateParagraph($request->validated(), $paragraph);

            return new MyJsonResponse($paragraph, Response::HTTP_CREATED);
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @param Paragraph $paragraph
     * @return ExceptionResponse|MyJsonResponse
     */
    public function destroy(Post $post, Paragraph $paragraph)
    {
        try {
            $paragraph->delete();

            return new MyJsonResponse(null, Response::HTTP_NO_CONTENT);
//            return MovieResource::make($movie)->additional(['message' => 'Movie Saved', 'success' => true]);
        } catch (\Throwable $e) {
            return new ExceptionResponse($e);
        }
    }
}
