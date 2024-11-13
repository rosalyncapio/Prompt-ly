//SQL
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    follower_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE prompts (
    prompt_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    created_by INT, -- Foreign key referencing users.user_id
    is_active BOOLEAN DEFAULT TRUE,
    start_date DATE,
    end_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);

CREATE TABLE entries (
    entry_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT, -- Foreign key referencing users.user_id
    prompt_id INT, -- Foreign key referencing prompts.prompt_id
    content TEXT NOT NULL,
    upvotes INT DEFAULT 0,
    downvotes INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (prompt_id) REFERENCES prompts(prompt_id)
);

CREATE TABLE votes (
    vote_id INT PRIMARY KEY AUTO_INCREMENT,
    entry_id INT, -- Foreign key referencing entries.entry_id
    user_id INT, -- Foreign key referencing users.user_id
    vote_type ENUM('up', 'down') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (entry_id) REFERENCES entries(entry_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE follows (
    follow_id INT PRIMARY KEY AUTO_INCREMENT,
    follower_id INT, -- User who follows
    following_id INT, -- User being followed
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (follower_id) REFERENCES users(user_id),
    FOREIGN KEY (following_id) REFERENCES users(user_id)
);

CREATE TABLE badges (
    badge_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    follower_threshold INT NOT NULL -- Minimum followers required for badge
);

CREATE TABLE user_badges (
    user_badge_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT, -- Foreign key referencing users.user_id
    badge_id INT, -- Foreign key referencing badges.badge_id
    awarded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (badge_id) REFERENCES badges(badge_id)
);

CREATE TABLE awards (
    award_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    upvote_threshold INT NOT NULL -- Minimum upvotes required for award
);

CREATE TABLE entry_awards (
    entry_award_id INT PRIMARY KEY AUTO_INCREMENT,
    entry_id INT, -- Foreign key referencing entries.entry_id
    award_id INT, -- Foreign key referencing awards.award_id
    awarded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (entry_id) REFERENCES entries(entry_id),
    FOREIGN KEY (award_id) REFERENCES awards(award_id)
);

