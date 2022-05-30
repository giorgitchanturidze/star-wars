<?php
require_once './dataabse.php';
require_once './function.php';
$keyword = $_POST['search'] ?? null;
if ($keyword !== null) {
  $data = decode($keyword);
}
if (!empty($data['count'])) {
  $name = $data['results'][0]['name'];
  $imagepath = "./img/characters/" . $data['results'][0]['name'] . ".jpg";
  $height = $data['results'][0]['height'];
  $mass = $data['results'][0]['mass'];
  $hair_color = $data['results'][0]['hair_color'];
  $skin_color = $data['results'][0]['skin_color'];
  $eye_color = $data['results'][0]['eye_color'];
  $birth_year = $data['results'][0]['birth_year'];
  $gender = $data['results'][0]['gender'];

  $statement = $pdo->prepare('SELECT * FROM star_wars WHERE name like :keyword');
  $statement->bindValue(":keyword", "%$name%");
  $statement->execute();
  $characters = $statement->fetchAll(PDO::FETCH_ASSOC);

  if (empty($characters)) {

    $statement = $pdo->prepare("INSERT IGNORE INTO star_wars (name, image, height, mass, hair_color,skin_color,eye_color,birth_year,gender)
              VALUES (:name, :image, :height, :mass, :hair_color, :skin_color, :eye_color, :birth_year, :gender)");
    $statement->bindValue(':name', $name);
    $statement->bindValue(':image', $imagepath);
    $statement->bindValue(':height', $height);
    $statement->bindValue(':mass', $mass);
    $statement->bindValue(':hair_color', $hair_color);
    $statement->bindValue(':skin_color', $skin_color);
    $statement->bindValue(':eye_color', $eye_color);
    $statement->bindValue(':birth_year', $birth_year);
    $statement->bindValue(':gender', $gender);

    $statement->execute();
  }
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/dist/output.css" rel="stylesheet">
  <title>Star Wars</title>
</head>

<body class="bg-black">
  <div class="flex p-2 space-x-3">
    <a href="./index.php" class="text-yellow-400 hover:underline ">Home</a>
    <a href="./searched.php" class="text-yellow-400 hover:underline ">Searched characters</a>
  </div>
  <p class="text-yellow-400 text-center text-xs font-thin">Star Wars</p>
  <p class="text-yellow-400 text-center text-base font-extralight">Star Wars</p>
  <p class="text-yellow-400 text-center text-xl font-light">Star Wars</p>
  <p class="text-yellow-400 text-center text-3xl font-normal">Star Wars</p>
  <p class="text-yellow-400 text-center text-5xl font-medium">Star Wars</p>
  <p class="text-yellow-400 text-center text-7xl font-bold">Star Wars</p>
  <p class="text-yellow-400 text-center text-8xl font-extrabold">Star Wars</p>

  <form method="POST">
    <label for="default-search" class="mb-2 text-sm font-medium text-yellow-400">Search</label>
    <div class="relative">
      <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
        <svg class="w-5 h-5 ext-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </div>
      <input type="search" name="search" value="<?php echo $keyword ?>" id="default-search" class="block p-4 pl-10 w-full text-xl text-yellow-400 bg-gray-700 " placeholder="Search Star War Characters..." required>
      <button type="submit" value class="text-black absolute right-2.5 bottom-3 bg-yellow-400 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Search</button>
    </div>
    </div>
  </form>
  <br>
  <?php if (!empty($data['count'])) : ?>
    <div class="flex justify-center  ">
      <a class="flex flex-col items-center bg-yellow-400 rounded-lg border shadow-md md:flex-row md:max-w-xl  dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="<?php echo $imagepath ?>" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><?php echo $name ?></h5>
          <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            Height: <?php echo $height ?> <br>
            Mass: <?php echo $mass ?> <br>
            Hair color: <?php echo $hair_color ?> <br>
            Skin color: <?php echo $skin_color ?> <br>
            Eye color: <?php echo $eye_color ?> <br>
            Birth year: <?php echo $birth_year ?> <br>
            Gender: <?php echo $gender ?> </p>
        </div>
      </a>
    </div>
  <?php endif; ?>
</body>

</html>