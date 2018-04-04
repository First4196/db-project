CREATE TABLE IF NOT EXISTS building(
    building_id	INTEGER(3) NOT NULL,
    name_en	VARCHAR(50),
    name_th	VARCHAR(50),
    name_abbrev VARCHAR(15),
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    CONSTRAINT building_pk PRIMARY KEY (building_id),
);
