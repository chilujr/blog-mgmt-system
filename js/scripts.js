// script.js

// Function to create a new post
// scripts.js

function createPost() {
    // Get form data
    const title = document.getElementById('title').value;
    const body = document.getElementById('body').value;
    const author = document.getElementById('author').value;
    const category = document.getElementById('category').value;

    // Create an object to hold the data
    const postData = {
        title: title,
        body: body,
        author: author,
        category: category
    };

    // Use fetch or another method to send the data to your server-side script
    fetch('api/create.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(postData),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
        // Optionally, update the UI or perform other actions after successful creation
    })
    .catch((error) => {
        console.error('Error:', error);
        // Handle errors appropriately
    });
}



// Function to read all posts
function readPosts() {
    // Implement your AJAX request to read all posts
    // Example using fetch API
    fetch('api/read.php')
    .then(response => response.json())
    .then(data => {
        console.log('Read Posts Response:', data);
        // Handle the list of posts here (display in UI, etc.)
    })
    .catch(error => {
        console.error('Error reading posts:', error);
    });
}

// Function to update a post
function updatePost() {
    // Implement your AJAX request to update a post using the data from the form
    // Example using fetch API
    fetch('api/update.php', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id: document.getElementById('updateId').value,
            title: document.getElementById('updateTitle').value,
            body: document.getElementById('updateBody').value,
            author: document.getElementById('updateAuthor').value,
            category: document.getElementById('updateCategory').value,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Update Post Response:', data);
        // Handle success or error here
    })
    .catch(error => {
        console.error('Error updating post:', error);
    });
}

// Function to delete a post
function deletePost() {
    // Implement your AJAX request to delete a post using the data from the form
    // Example using fetch API
    fetch('api/delete.php', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id: document.getElementById('deleteId').value,
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Delete Post Response:', data);
        // Handle success or error here
    })
    .catch(error => {
        console.error('Error deleting post:', error);
    });
}
