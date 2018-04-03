CREATE TABLE IF NOT EXISTS professor(
    professor_id VARCHAR(11) NOT NULL,
    name_th VARCHAR(50),
    name_en VARCHAR(50),
    name_abbrev VARCHAR(3),
    date_of_birth DATE,
    address VARCHAR(100),
    mobile_no VARCHAR(15),
    email VARCHAR(50),
    CONSTRAINT professor_pk PRIMARY KEY (professor_id)
);
