<?php include $this->resolve("partials/_header.php"); ?>
<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded ">
    <form method="POST" class="grid grid-cols-1 gap-6">
        <?php include $this->resolve("partials/_csrf.php"); ?>
        <label class="block">
            <span class="text-gray-700">Email Address</span>
            <input type="email" value="<?php echo htmlChars($old['email'] ?? "") ?>" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com">
        </label>
        <?php if (array_key_exists('email', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['email'][0] ?></p>
        <?php endif; ?>
        <label class="block">
            <span class="text-gray-700">Password</span>
            <input type="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </label>
        <?php if (array_key_exists('password', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['password'][0] ?></p>
        <?php endif; ?>
        <button type="submit" class="block w-full py-2 bg-blue-600 text-white rounded">
            Submit
        </button>
    </form>
</section>
<?php include $this->resolve("partials/_footer.php"); ?>