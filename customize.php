<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if (!isset($user_id)) {
        header('location:login.php');
    }
?>
<style type="text/css">
    <?php include 'main.css'; ?>

    /* Styling for the dropdown container */
    .model-selector-container {
        text-align: center;
        margin: 20px auto;
        font-family: Arial, sans-serif;
    }

    /* Styling for the label */
    .model-selector-container label {
        font-size: 1.2em;
        margin-bottom: 10px;
        display: inline-block;
        color: #333;
    }

    /* Styling for the select dropdown */
    #modelSelector {
        padding: 10px 20px;
        font-size: 1em;
        cursor: pointer;
        background-color: #f8f9fa;
        border: 2px solid #ccc;
        border-radius: 5px;
        transition: background-color 0.3s ease, border-color 0.3s ease;
        outline: none;
    }

    /* Hover and focus states for the dropdown */
    #modelSelector:hover, #modelSelector:focus {
        background-color: #e9ecef;
        border-color: #007bff;
    }

    /* Styling for the 3D model viewer */
    model-viewer {
        width: 100%;
        height: 500px; /* Adjust height as needed */
        margin: 20px auto;
        display: block;
        border: 2px solid #ddd;
        border-radius: 8px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Deelight</title>
</head>
<body>
    <!-- Include Header -->
    <?php include 'header.php'; ?>

    <!-- Styled Model Selection Dropdown -->
    <div class="model-selector-container">
        <label for="modelSelector">Choose your cake option:</label>
        <select id="modelSelector">
            <option value="cake%20strawberry.glb">Strawberry Cake</option>
            <option value="cake%20pebbles.glb">Pebbles Cake</option>
            <option value="cake%20cherry.glb">Cherry Cake</option>
        </select>
    </div>

    <!-- 3D Model Viewer -->
    <model-viewer 
        id="modelViewer"
        src="mymodel/cake%20strawberry.glb" 
        alt="A 3D model of a strawberry cake" 
        auto-rotate 
        camera-controls 
        ar
        shadow-intensity="1"
        exposure="0.8">
    </model-viewer>

    
    <?php include 'footer.php'; ?>
    
    <!-- Scripts -->
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
    <script type="text/javascript" src="script.js"></script>

    <script>
       
        document.getElementById('modelSelector').addEventListener('change', function() {
            const selectedModel = this.value;
            const modelViewer = document.getElementById('modelViewer');
            modelViewer.src = 'mymodel/' + selectedModel;
        });
    </script>
</body>
</html>
