<?php
$conn= require("dbconnect.php");
$sql="SELECT 
    post_date,
    SUM(total_posts_and_comments) AS total
    FROM (
    SELECT 
        DATE(Post.created_at) AS post_date,
        COUNT(Post.id) + COUNT(Comment.id) AS total_posts_and_comments
    FROM 
        Post
    LEFT JOIN 
        Comment ON DATE(Post.created_at) = DATE(Comment.created_at)
    WHERE 
        Post.created_at >= DATE_SUB(NOW(), INTERVAL 1 WEEK)
    GROUP BY 
        post_date
    ) AS subquery
    GROUP BY 
    post_date
    ORDER BY 
    post_date ASC;


";
$result = $conn->query($sql);
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
?>