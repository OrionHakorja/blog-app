<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f7f7;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 28px;
        font-weight: 600;
    }

    label {
        display: block;
        margin-top: 15px;
        font-weight: 500;
        color: #555;
    }

    input[type="text"],
    textarea,
    input[type="datetime-local"] {
        width: 100%;
        padding: 12px 15px;
        margin-top: 8px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    textarea:focus,
    input[type="datetime-local"]:focus {
        border-color: #007bff;
        outline: none;
    }

    textarea {
        resize: vertical;
    }

    input[type="submit"],
    button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        border-radius: 8px;
        margin-top: 20px;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover,
    button:hover {
        background-color: #218838;
    }

    /* Optional: Add subtle hover effect on input fields */
    input:hover,
    textarea:hover {
        border-color: #ccc;
    }
</style>

<div class="container">
    <h2>Edit Blog</h2>
    <form action="{{route('blogs.update', $blog->id)}}" method="POST">
        @method('PUT')
        @csrf
        <!-- Blog Name -->
        <label for="name">Blog's Name:</label>
        <input type="text" id="name" name="name" required value="{{$blog->name}}">

        <!-- Blog Description -->
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="5" required>{{$blog->description}}</textarea>

        <!-- Update Button -->
        <button type="submit">Update Blog</button>
    </form>
</div>
