CREATE TABLE IF NOT EXISTS news(
    course_id VARCHAR(7) NOT NULL,
    course_year INTEGER(4) UNSIGNED NOT NULL,
    course_semester INTEGER(1) UNSIGNED NOT NULL,
    course_section INTEGER(2) UNSIGNED NOT NULL,
    publish_time DATETIME NOT NULL,
    title VARCHAR(50),
    detail TEXT,
    CONSTRAINT news_pk PRIMARY KEY (course_id,course_year,course_semester,course_section,publish_time),
    CONSTRAINT news_fk FOREIGN KEY (course_id,course_year,course_semester,course_section)
    REFERENCES course_section(course_id,course_year,course_semester,course_section),
    CONSTRAINT news_time CHECK(YEAR(publish_time) BETWEEN course_year AND course_year+1)
);
