CREATE TABLE IF NOT EXISTS curriculum(
	  curriculum_id VARCHAR(5),
    name_en VARCHAR(50),
    name_th VARCHAR(50),
    start_year INTEGER(4),
    CONSTRAINT curricululm_pk PRIMARY KEY (curriculum_id)
);
