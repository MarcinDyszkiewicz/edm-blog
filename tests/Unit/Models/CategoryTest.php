<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Illuminate\Foundation\Testing\Concerns\InteractsWithContainer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    use InteractsWithContainer;

    private Category $category;

    public function setUp(): void
    {
        parent::setUp();

        $this->category = $this->createMock(Category::class);
//        $this->createMock()
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
//        dd($this->category);
        $this->assertTrue(true);
    }
}
