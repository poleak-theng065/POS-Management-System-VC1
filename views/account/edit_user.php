<form action="/user_account/update" method="POST">
    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
    <label>Username:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br>

    <label>Role:</label>
    <select name="role">
        <?php foreach (['admin', 'cashier', 'employee'] as $role): ?>
            <option value="<?= $role ?>" <?= $user['role'] === $role ? 'selected' : '' ?>><?= ucfirst($role) ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Password (leave blank to keep current):</label>
    <input type="password" name="password"><br>

    <label>Profile Image URL:</label>
    <input type="text" name="image" value="<?= htmlspecialchars($user['image']) ?>"><br>

    <button type="submit">Update User</button>
</form>
