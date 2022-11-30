<?php

namespace App\Controller;

use App\model\Post;

class PostController
{
    private $post;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->post = new Post();
    }

    /**
     * Index
     */
    public function index()
    {
        $title = 'All Posts';

        // All posts
        // $posts = $this->post->all();

        // All posts by pagination
        $start = $_GET['start'] ?? 0;
        $count = 5;
        $posts = $this->post->paginate($start, $count);
        $total = $this->post->count();

        // return view('post/index', compact('title', 'posts'));
        return view('post/index', compact('title', 'posts', 'start', 'total', 'count'));
    }

    /**
     * Show
     *
     * @param $id
     */
    public function show($id)
    {
        $post = $this->post->find($id);

        $title = $post['title'];

        return view('post/show', compact('title', 'post'));
    }

    /**
     * Create
     */
    public function create()
    {
        $title = 'Create Post';

        return view('post/create', compact('title'));
    }

    /**
     * Store
     */
    public function store()
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if ($title && $content) {
            $result = $this->post->create($title, $content);

            if ($result) {
                session_set('success', 'Post created.');
                return redirect('post');
            }
        }

        session_set('fail', 'The title and content field is required.');
        return redirect('post/create');
    }

    /**
     * Edit
     *
     * @param $id
     */
    public function edit($id)
    {
        $title = 'Edit Posts';
        $post = $this->post->find($id);

        return view('post/edit', compact('title', 'post'));
    }

    /**
     * Update
     */
    public function update()
    {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if ($title && $content) {
            $result = $this->post->update($title, $content);

            if ($result) {
                session_set('success', 'Post updated.');
                return redirect('post');
            }
        }

        session_set('fail', 'The title and content field is required.');
        return redirect('post/edit');
    }

    /**
     * Delete
     *
     * @param $id
     */
    public function delete($id)
    {
        $result = $this->post->delete($id);

        if ($result) {
            session_set('success', 'Post deleted.');
            return redirect('post');
        }

        session_set('fail', 'The title and content field is required.');
        return redirect('post');
    }

    /**
     * Generate
     */
    public function generate()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 32; $i++) {
            $this->post->create($faker->text(10), $faker->text(500));
        }

        session_set('success', 'Post created.');
        return redirect('post');
    }
}
