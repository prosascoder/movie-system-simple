<html>
  <head>
    <title>MOVIE & DIRECTORS</title>
  </head>
  <style>
     body {
        background-color: grey; 
    }

    h1 {
        text-align: center;
        font-size: 32px;
        margin-bottom: 40px;
        margin-top: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 2px solid black;
        border-radius: 10px;
        box-shadow: 100px 200px 400px rgba(0,0,0,0.3);
        padding: 20px;
        width: 50%;
        margin: 0 auto;
        background-color: skyblue;
    }

    form label, form input[type="text"], form button[type="submit"] {
        margin: 10px 0;
        font-size: 20px;
    }

    form input[type="text"] {
        border-radius: 5px;
        border: 1px solid #ccc;
        padding: 8px;
    }

    form button[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    form button[type="submit"]:hover {
        background-color: #0069d9;
    }

    form button[type="submit"]:active {
        background-color: #0062cc;
    }

    form button[type="submit"]:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
    }

    table {
        margin-top: 40px;
        border-collapse: collapse;
        width: 50%;
        margin: 0 auto;
    }

    table caption {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    table th, table td {
        border: 2px solid black;
        padding: 10px;
        text-align: center;
    }

    table th {
        background-color: #007bff;
        color: white;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #ddd;
    }
    form:hover {
    transform: scale(1.2);
    transition: 1s ease-in-out;
}
    
</style>

<body>
    <h1>MOVIE & DIRECTORS</h1>
    <form method="post" onsubmit="return validateForm()">
        <label for="person_id">Enter person ID: </label>
        <input type="text" name="person_id" id="person_id">
        <br>
        <button type="submit">Check</button>
    </form>
    <?php
    $dsn = 'sqlite:movies.db';
    $username = null;
    $password = null;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $person_id = $_POST['person_id'];

        if (empty($person_id)) {
            echo '<script>alert("Please enter a person ID")</script>';
            exit();
        }

        try {
            $pdo = new PDO($dsn, $username, $password, $options);
        } catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit();
        }

        // First question: check if person has directed any movies
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM directors WHERE person_id = :person_id");
        $stmt->execute(['person_id' => $person_id]);
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            echo '<script>alert("This person has not directed any movies.")</script>';
        } else {
            $stmt = $pdo->prepare("
            SELECT m.year, COUNT(*) as num_films
            FROM movies m
            JOIN directors d ON m.id = d.movie_id
            WHERE d.person_id = :person_id
            GROUP BY m.year
            ORDER BY m.year DESC
            ");
            $stmt->execute(['person_id' => $person_id]);
            $films_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($films_result)) {
                echo '<script>alert("Data does not exist")</script>';
                exit();
            }

            echo "<table><caption>Number of films directed yearwise</caption><thead><tr><th>Year</th><th>Number of films</th></tr></thead><tbody>";
            foreach ($films_result as $row) {
                echo "<tr><td>{$row['year']}</td><td>{$row['num_films']}</td></tr>";
            }
            echo "</tbody></table>";

            // Second question: display stars who have appeared in at least two movies directed by the person
            $stmt = $pdo->prepare("
            SELECT p.name, COUNT(*) as num_films
            FROM people p
            JOIN stars s1 ON p.id = s1.person_id
            JOIN movies m1 ON s1.movie_id = m1.id
            JOIN directors d ON m1.id = d.movie_id
            JOIN stars s2 ON m1.id = s2.movie_id
            JOIN people p2 ON s2.person_id = p2.id
            WHERE d.person_id = :person_id AND p2.id <> :person_id
            GROUP BY p.name
            HAVING COUNT(DISTINCT m1.id) >= 2
            ORDER BY num_films DESC
            ");
            $stmt->execute(['person_id' => $person_id]);
            $stars = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($stars)) {
                echo '<script>alert("Data does not exist")</script>';
                exit();
            }
            
            echo '<table style="border-collapse: collapse; width: 100%;">';
            echo '<caption style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Stars who have appeared in at least two movies directed by the person</caption>';
            echo '<thead style="background-color: #f2f2f2; font-weight: bold;"><tr><td>Name</td><td>Number of Films</td></tr></thead>';
            echo '<tbody>';
            
            foreach ($stars as $row) {
                echo "<tr><td>{$row['name']}</td><td>{$row['num_films']}</td></tr>";
            }
            echo "</tbody></table>";
        }
    }
    ?>
</body>
</html>
