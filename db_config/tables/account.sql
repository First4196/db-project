CREATE TABLE IF NOT EXISTS account(
    username VARCHAR(30) NOT NULL,
    password VARCHAR(40) NOT NULL,
    type ENUM('student','professor','staff'),
    CONSTRAINT account_pk PRIMARY KEY (username)
);
