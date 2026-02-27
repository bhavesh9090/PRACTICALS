<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Railway Ticket Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px gray;
            border-radius: 5px;
        }
        h2 {
            text-align: center;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Railway Ticket Reservation</h2>
    <?php
    $nameErr = $emailErr = $ageErr = $genderErr = $fromErr = $toErr = "";
    $name = $email = $age = $gender = $from = $to = $date = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
        if (empty($_POST["age"])) {
            $ageErr = "Age is required";
        } else {
            $age = test_input($_POST["age"]);
            if (!is_numeric($age) || $age < 1) {
                $ageErr = "Invalid age";
            }
        }
        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }
        if (empty($_POST["from"])) {
            $fromErr = "Departure location is required";
        } else {
            $from = test_input($_POST["from"]);
        }
        if (empty($_POST["to"])) {
            $toErr = "Destination is required";
        } else {
            $to = test_input($_POST["to"]);
        }
        if (empty($_POST["date"])) {
            $date = "";
        } else {
            $date = test_input($_POST["date"]);
        }
        if ($nameErr == "" && $emailErr == "" && $ageErr == "" && $genderErr == "" && $fromErr == "" && $toErr == "") {
            echo "<h3 style='color:green;'>Booking Confirmed!</h3>";
            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Age:</strong> $age</p>";
            echo "<p><strong>Gender:</strong> $gender</p>";
            echo "<p><strong>From:</strong> $from</p>";
            echo "<p><strong>To:</strong> $to</p>";
            echo "<p><strong>Date of Journey:</strong> $date</p>";
        }
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>
        <label for="age">Age:</label>
        <input type="text" id="age" name="age" value="<?php echo $age; ?>">
        <span class="error"><?php echo $ageErr; ?></span>
        <label>Gender:</label>
        <select name="gender">
            <option value="">Select Gender</option>
            <option value="Male" <?php if ($gender == "Male") echo "selected"; ?>>Male</option>
            <option value="Female" <?php if ($gender == "Female") echo "selected"; ?>>Female</option>
            <option value="Other" <?php if ($gender == "Other") echo "selected"; ?>>Other</option>
        </select>
        <span class="error"><?php echo $genderErr; ?></span>
        <label for="from">From:</label>
        <input type="text" id="from" name="from" value="<?php echo $from; ?>">
        <span class="error"><?php echo $fromErr; ?></span>
        <label for="to">To:</label>
        <input type="text" id="to" name="to" value="<?php echo $to; ?>">
        <span class="error"><?php echo $toErr; ?></span>
        <label for="date">Date of Journey:</label>
        <input type="date" id="date" name="date" value="<?php echo $date; ?>">
        <button type="submit">Book Ticket</button>
    </form>
</div>
</body>
</html>