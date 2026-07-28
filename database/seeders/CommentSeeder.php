<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create(['project_id'=>1, 'name'=>'daruosh', 'contact'=>'09149001840', 'content'=>'تابلویی زیباست']);
        Comment::create(['project_id'=>1, 'parent_id'=>1, 'name'=>'daruosh', 'contact'=>'09339981840', 'content'=>'تابلویی زیباست']);
    }
}
