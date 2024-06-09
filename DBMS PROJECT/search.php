<?php
include 'connection.php';

if (isset($_GET['query'])) {
    $query = $_GET['query'];
    // Use prepared statements for security
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2>Search Results for '" . htmlspecialchars($query) . "'</h2>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Assuming 'details_page' holds the page name without extension
            $detailsPage = str_replace('.html', '.php', $row['details_page']);
            echo "<div class='col-4'>";
            echo "<a href='" . $detailsPage . "?id=" . $row['id'] . "'><img src='" . $row['images'] . "'></a>";
            echo "<a href='" . $detailsPage . "?id=" . $row['id'] . "'><h4>" . $row['name'] . "</h4></a>";
            echo "<p>" . $row['price'] . "pkr</p>";
            echo "</div>";
        }
    } else {
        echo "No products found.";
    }

    $stmt->close();
} else {
    echo "Search query missing.";
}

$conn->close();
?>
