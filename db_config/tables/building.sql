CREATE TABLE IF NOT EXISTS building(
    building_id	VARCHAR(4) NOT NULL,
    name_en	VARCHAR(50),
    name_th	VARCHAR(50),
    name_abbrev VARCHAR(15),
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    faculty CHAR(2),
    CONSTRAINT building_pk PRIMARY KEY (building_id),
    CONSTRAINT building_fk FOREIGN KEY (faculty) REFERENCES faculty(faculty_code)
);
