<?php
require_once './dataabse.php';
require_once './function.php';
$keyword = $_GET['search'] ?? null;

if ($keyword) {
    $statement = $pdo->prepare('SELECT * FROM star_wars WHERE name like :keyword');
    $statement->bindValue(":keyword", "%$keyword%");
} else {
    $statement = $pdo->prepare('SELECT * FROM star_wars ');
}
$statement->execute();
$characters = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Searched characters</title>
</head>

<body class="class=" bg-black"">
    <div class="p-2 space-x-6">
        <a href="./index.php" class="text-yellow-400 hover:underline ">Home</a>
        <a href="./searched.php" class="text-yellow-400 hover:underline ">Searched characters</a>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form method="GET">
            <div class="p-4">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="space-x-6">
                        <input type="text" id="table-search" name="search" value="<?php echo $keyword ?>" class="bg-gray-800 border border-gray-300 text-yellow-400 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for characters">
                    </div>
                </div>
                <br>
                <button type="submit" class="p-2.5 ml-5 text-sm font-medium text-black bg-yellow-400 rounded-lg ">Search</button>
            </div>
        </form>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-yellow-400 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Image
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Height
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Mass
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Hair color
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Skin color
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Eye color
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Birth year
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Gender
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Delete</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($characters as $character) : ?>
                    <tr class="bg-yellow-100 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-yellow-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4">
                            <img class="w-10 h-10 rounded-full" src="<?php echo $character['image'] ?>">
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            <?php echo $character['name'] ?>
                        </th>
                        <td class="px-6 py-4">
                            <?php echo $character['height'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $character['mass'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $character['hair_color'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $character['skin_color'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $character['eye_color'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $character['birth_year'] ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $character['gender'] ?>
                        </td>
                        <form method="post" action="delete.php" style="display: inline-block">
                            <td class="px-6 py-4 text-right">
                                <input type="hidden" name="id" value="<?php echo $character['id'] ?>" />
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</body>

</html>