<aside>
    <div class="board-form nes-container is-rounded">
        <h2>掲示板作成</h2>
        <form method="post" action="create_board.php?theme_id=<?= htmlspecialchars($theme_id) ?>">
            <div class="nes-field">
                <label for="title">募集タイトル</label>
                <input type="text" id="title" name="title" class="nes-input" required>
            </div>
            <div class="nes-field">
                <label for="content">募集内容</label>
                <textarea id="content" name="content" class="nes-textarea" required></textarea>
            </div>
            <button type="submit" class="nes-btn is-primary">作成</button>
        </form>
    </div>
</aside>