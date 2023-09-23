<?php include $this->resolve("partials/_header.php"); ?>

<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <form class="grid grid-cols-1 gap-6" method="post" action="/register">
        <!-- Email -->
        <label class="block">
            <span class="text-gray-700">Email address</span>
            <input value="<?php echo $old['email'] ?? ''; ?>" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="john@example.com" />
        </label>
        <?php if (array_key_exists('email', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['email'][0] ?></p>
        <?php endif; ?>
        <!-- Age -->
        <label class="block">
            <span class="text-gray-700">Age</span>
            <input value="<?php echo $old['age'] ?? ''; ?>" name="age" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
        </label>
        <?php if (array_key_exists('age', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['age'][0]  ?></p>
        <?php endif; ?>
        <!-- Country -->
        <label class="block">
            <span class="text-gray-700">Country</span>
            <select name="country" class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="Invalid" <?php echo $old['country'] ?? '' == 'Invalid' ? 'selected' : ''; ?>>Select Country</option>
                <option value="USA" <?php echo $old['country'] ?? '' == 'USA' ? 'selected' : ''; ?>>USA</option>
                <option value="Canada" <?php echo $old['country'] ?? '' == 'Canada' ? 'selected' : ''; ?>>Canada</option>
                <option value="Mexico" <?php echo $old['country'] ?? '' == 'Mexico' ? 'selected' : ''; ?>>Mexico</option>
                <option value="Nigeria" <?php echo $old['country'] ?? '' == 'Nigeria' ? 'selected' : ''; ?>>Nigeria</option>
            </select>
        </label>
        <?php if (array_key_exists('country', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['country'][0] ?></p>
        <?php endif; ?>
        <!-- Social Media URL -->
        <label class="block">
            <span class="text-gray-700">Social Media URL</span>
            <input value="<?php echo $old['socialMediaURL'] ?? ""; ?>" name="socialMediaURL" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
        </label>
        <?php if (array_key_exists('socialMediaURL', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['socialMediaURL'][0] ?></p>
        <?php endif; ?>
        <!-- Password -->
        <label class="block">
            <span class="text-gray-700">Password</span>
            <input name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
        </label>
        <?php if (array_key_exists('password', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['password'][0] ?></p>
        <?php endif; ?>
        <!-- Confirm Password -->
        <label class="block">
            <span class="text-gray-700">Confirm Password</span>
            <input name="confirmPassword" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="" />
        </label>
        <?php if (array_key_exists('confirmPassword', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['confirmPassword'][0] ?></p>
        <?php endif; ?>
        <!-- Terms of Service -->
        <div class="block">
            <div class="mt-2">
                <div>
                    <label class="inline-flex items-center">
                        <input <?php echo $old['tos'] ?? false ? 'checked' : '' ?> name="tos" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-offset-0 focus:ring-indigo-200 focus:ring-opacity-50" type="checkbox" />
                        <span class="ml-2">I accept the terms of service.</span>
                    </label>
                </div>
            </div>
        </div>
        <?php if (array_key_exists('tos', $errors)) : ?>
            <p class="bg-gray-100 mt-2 p-2 text-red-500"><?php echo $errors['tos'][0] ?></p>
        <?php endif; ?>
        <button type="submit" class="block w-full py-2 bg-indigo-600 text-white rounded">
            Submit
        </button>
    </form>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>