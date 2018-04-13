CREATE TABLE IF NOT EXISTS account(
    account_id INTEGER NOT NULL AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(40) NOT NULL,
    type ENUM('student','professor','moderator'),
    CONSTRAINT account_pk PRIMARY KEY (account_id)
);