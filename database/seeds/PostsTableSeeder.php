<?php

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $category1=Category::create([
            'name'=>'News'
        ]);
        $category2=Category::create([
            'name'=>'Design'
        ]);
        $category3=Category::create([
            'name'=>'Marketing'
        ]);
        $category4=Category::create([
            'name'=>'Product'
        ]);
        
        $tag1=Tag::create([
            'name'=>'Record'
        ]);
        $tag2=Tag::create([
            'name'=>'Progress'
        ]);
        $tag3=Tag::create([
            'name'=>'Customers'
        ]);
        $tag4=Tag::create([
            'name'=>'Job'
        ]);
        
        $post1=Post::create([
            
            'name'=> 'We relocated our office to a new designed garage',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'category_id'=> $category1,
        ]);

        $post2=Post::create([
            
            'name'=> 'Top 5 brilliant content marketing strategies',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'category_id'=> $category2,
        ]);

        $post3=Post::create([
            
            'name'=> 'Best practices for minimalist design with example',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'category_id'=> $category3,
        ]);

        $post4=Post::create([
            
            'name'=> 'Congratulate and thank to Maryam for joining our team',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'category_id'=> $category4,
        ]);
    
        $post1=tags()->attach([$tag1->id,$tag2->id]);
        $post2=tags()->attach([$tag2->id,$tag3->id]);
        $post3=tags()->attach([$tag3->id,$tag1->id]);

    
    }
}
