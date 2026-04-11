# Database Schema Documentation

## Tables and Relationships

### `users`
- Columns:
  - `id`
  - `name`
  - `username` (unique)
  - `avatar_url`
  - `email` (unique)
  - `email_verified_at`
  - `password`
  - `remember_token`
  - `created_at`, `updated_at`
- Notes:
  - Core user table.

### `authors`
- Columns:
  - `id`
  - `name`
  - `date`
  - `address`
  - `description`
  - `bio`
  - `created_at`, `updated_at`
- Notes:
  - Story authors. No foreign keys in this table.

### `stories`
- Columns:
  - `id`
  - `title`
  - `slug` (unique)
  - `description`
  - `avatar_url`
  - `author_id` (nullable)
  - `status` (tinyInteger)
  - `cover_url`
  - `view_count`
  - `like_count`
  - `created_at`, `updated_at`, `deleted_at`
- Foreign keys:
  - `author_id` → `authors.id`
    - `nullable`
    - `nullOnDelete()`
- Notes:
  - A story may have one author.

### `chapters`
- Columns:
  - `id`
  - `story_id`
  - `chapter_number`
  - `title`
  - `access_type` (`free`, `coin`, `premium`)
  - `coin_price`
  - `money_price`
  - `view_count`
  - `created_at`, `updated_at`
- Foreign keys:
  - `story_id` → `stories.id`
    - `cascadeOnDelete()`
- Indexes:
  - unique(`story_id`, `chapter_number`)
  - index(`story_id`, `chapter_number`)
- Notes:
  - Each chapter belongs to one story.

### `chapter_contents`
- Columns:
  - `id`
  - `chapter_id` (unique)
  - `content`
  - `created_at`, `updated_at`
- Foreign keys:
  - `chapter_id` → `chapters.id`
    - `unique`
    - `cascadeOnDelete()`
- Notes:
  - One-to-one content record per chapter.

### `genres`
- Columns:
  - `id`
  - `name` (unique)
  - `slug` (unique)
  - `created_at`, `updated_at`
- Notes:
  - Genre lookup table.

### `story_genres`
- Columns:
  - `story_id`
  - `genre_id`
- Foreign keys:
  - `story_id` → `stories.id`
    - `cascadeOnDelete()`
  - `genre_id` → `genres.id`
- Primary key:
  - composite(`story_id`, `genre_id`)
- Notes:
  - Many-to-many relationship between stories and genres.

### `comments`
- Columns:
  - `id`
  - `user_id`
  - `story_id` (nullable)
  - `chapter_id` (nullable)
  - `content`
  - `created_at`, `updated_at`, `deleted_at`
- Foreign keys:
  - `user_id` → `users.id`
  - `story_id` → `stories.id`
    - `nullable`
    - `nullOnDelete()`
  - `chapter_id` → `chapters.id`
    - `nullable`
    - `nullOnDelete()`
- Indexes:
  - index(`story_id`)
  - index(`chapter_id`)
- Notes:
  - A comment belongs to a user and optionally to a story or chapter.

### `bookmarks`
- Columns:
  - `id`
  - `user_id`
  - `chapter_id`
  - `created_at`, `updated_at`
- Foreign keys:
  - `user_id` → `users.id`
    - `cascadeOnDelete()`
  - `chapter_id` → `chapters.id`
    - `cascadeOnDelete()`
- Unique constraint:
  - unique(`user_id`, `chapter_id`)
- Notes:
  - Tracks user bookmarks on chapters.

### `follows`
- Columns:
  - `user_id`
  - `story_id`
  - `created_at`, `updated_at`
- Foreign keys:
  - `user_id` → `users.id`
  - `story_id` → `stories.id`
- Primary key:
  - composite(`user_id`, `story_id`)
- Notes:
  - Users follow stories.

### `reading_histories`
- Columns:
  - `id`
  - `user_id`
  - `story_id`
  - `chapter_id`
  - `last_read_at`
- Foreign keys:
  - `user_id` → `users.id`
  - `story_id` → `stories.id`
  - `chapter_id` → `chapters.id`
- Constraints:
  - unique(`user_id`, `story_id`)
- Indexes:
  - index(`user_id`, `last_read_at`)
- Notes:
  - One history entry per user/story.

### `story_ratings`
- Columns:
  - `user_id`
  - `story_id`
  - `rating`
  - `created_at`, `updated_at`
- Foreign keys:
  - `user_id` → `users.id`
  - `story_id` → `stories.id`
- Primary key:
  - composite(`user_id`, `story_id`)
- Notes:
  - Users rate stories.

### `reading_progresss`
- Columns:
  - `id`
  - `user_id`
  - `story_id`
  - `chapter_id`
  - `scroll_percent`
  - `last_read_at`
  - `created_at`, `updated_at`
- Foreign keys:
  - `user_id` → `users.id`
    - `cascadeOnDelete()`
  - `story_id` → `stories.id`
    - `cascadeOnDelete()`
  - `chapter_id` → `chapters.id`
    - `cascadeOnDelete()`
- Constraints:
  - unique(`user_id`, `story_id`)
- Indexes:
  - index(`user_id`, `last_read_at`)
- Notes:
  - Tracks scroll progress and last read time per user/story.

## Relationship Summary
- `stories.author_id` → `authors.id`
- `chapters.story_id` → `stories.id`
- `chapter_contents.chapter_id` → `chapters.id`
- `story_genres.story_id` → `stories.id`
- `story_genres.genre_id` → `genres.id`
- `comments.user_id` → `users.id`
- `comments.story_id` → `stories.id`
- `comments.chapter_id` → `chapters.id`
- `bookmarks.user_id` → `users.id`
- `bookmarks.chapter_id` → `chapters.id`
- `follows.user_id` → `users.id`
- `follows.story_id` → `stories.id`
- `reading_histories.user_id` → `users.id`
- `reading_histories.story_id` → `stories.id`
- `reading_histories.chapter_id` → `chapters.id`
- `story_ratings.user_id` → `users.id`
- `story_ratings.story_id` → `stories.id`
- `reading_progresss.user_id` → `users.id`
- `reading_progresss.story_id` → `stories.id`
- `reading_progresss.chapter_id` → `chapters.id`

## Notes on cascade / delete behavior
- `stories.author_id` uses `nullOnDelete()`
- `chapters.story_id` cascades delete when a story is removed
- `chapter_contents.chapter_id` cascades delete when a chapter is removed
- `story_genres.story_id` cascades delete when a story is removed
- `bookmarks.user_id`, `bookmarks.chapter_id` cascade delete
- `reading_histories` and `reading_progresss` all cascade deletes on related users/stories/chapters

## Optional tables
- `password_reset_tokens`
  - `email` (primary)
  - `token`
  - `created_at`
- `sessions`
  - `id` (primary)
  - `user_id`
  - `ip_address`
  - `user_agent`
  - `payload`
  - `last_activity`
