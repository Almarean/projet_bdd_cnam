DROP TABLE IF EXISTS contact CASCADE;
CREATE TABLE contact (
    id SERIAL PRIMARY KEY,
    name character varying(255) NOT NULL,
    firstname character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone character varying(255) DEFAULT NULL::character varying
);

DROP TABLE IF EXISTS event CASCADE;
CREATE TABLE event (
    id SERIAL PRIMARY KEY,
    label character varying(255) NOT NULL,
    description text NOT NULL,
    date_publication timestamp NOT NULL,
    place character varying(255) NOT NULL,
    type_event character varying(255) NOT NULL,
    event_date timestamp NOT NULL,
    image character varying(255) NULL,
    author_id integer
);

DROP TABLE IF EXISTS guest CASCADE;
CREATE TABLE guest (
    id SERIAL PRIMARY KEY,
    name character varying(255) NOT NULL,
    firstname character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone character varying(255) DEFAULT NULL::character varying,
    password character varying(255) NOT NULL,
    is_confirmed boolean NOT NULL,
    roles json NOT NULL
);

DROP TABLE IF EXISTS migration_versions CASCADE;
CREATE TABLE migration_versions (
    version character varying(14) NOT NULL,
    executed_at timestamp(0) without time zone NOT NULL
);

COMMENT ON COLUMN migration_versions.executed_at IS '(DC2Type:datetime_immutable)';

DROP TABLE IF EXISTS news CASCADE;
CREATE TABLE news (
    id SERIAL PRIMARY KEY,
    label character varying(255) NOT NULL,
    description text NOT NULL,
    date_publication timestamp NOT NULL,
    image character varying(255) NULL,
    author_id integer
);

DROP TABLE IF EXISTS participation CASCADE;
CREATE TABLE participation (
    id SERIAL PRIMARY KEY,
    guest_id integer,
    event_id integer,
    nb_persons integer,
    participe boolean NOT NULL
);

DROP TABLE IF EXISTS project CASCADE;
CREATE TABLE project (
    id SERIAL PRIMARY KEY,
    label character varying(255) NOT NULL,
    description text NOT NULL,
    date_publication timestamp NOT NULL,
    image character varying(255) NULL,
    end_date timestamp NOT NULL,
    author_id integer
);

DROP TABLE IF EXISTS project_guest CASCADE;
CREATE TABLE project_guest (
    project_id integer NOT NULL,
    guest_id integer NOT NULL,
    PRIMARY KEY(project_id, guest_id)
);

ALTER TABLE ONLY migration_versions ADD CONSTRAINT migration_versions_pkey PRIMARY KEY (version);

ALTER TABLE contact OWNER TO postgres;
ALTER TABLE event OWNER TO postgres;
ALTER TABLE guest OWNER TO postgres;
ALTER TABLE news OWNER TO postgres;
ALTER TABLE migration_versions OWNER TO postgres;
ALTER TABLE participation OWNER TO postgres;
ALTER TABLE project OWNER TO postgres;
ALTER TABLE project_guest OWNER TO postgres;

ALTER TABLE ONLY news ADD CONSTRAINT fk_news_guest FOREIGN KEY (author_id) REFERENCES guest(id);
ALTER TABLE ONLY event ADD CONSTRAINT fk_event_guest FOREIGN KEY (author_id) REFERENCES guest(id);
ALTER TABLE ONLY participation ADD CONSTRAINT fk_participation_event FOREIGN KEY (event_id) REFERENCES event(id);
ALTER TABLE ONLY participation ADD CONSTRAINT fk_participation_guest FOREIGN KEY (guest_id) REFERENCES guest(id);
ALTER TABLE ONLY project_guest ADD CONSTRAINT fk_project_guest_project FOREIGN KEY (project_id) REFERENCES project(id) ON DELETE CASCADE;
ALTER TABLE ONLY project_guest ADD CONSTRAINT fk_project_guest_guest FOREIGN KEY (guest_id) REFERENCES guest(id) ON DELETE CASCADE;

CREATE OR REPLACE FUNCTION func_check_event_date(event_date timestamp)
RETURNS bool AS $$
BEGIN
    RETURN EXISTS
    (SELECT ok FROM
    (SELECT (event_date > NOW()) AS ok) AS t1
    WHERE ok = true);
END;
$$ LANGUAGE PLPGSQL;


CREATE OR REPLACE FUNCTION test_event_date()
RETURNS TRIGGER
AS $$
BEGIN
    IF (func_check_event_date(new.event_date)) THEN
        RETURN new;
    ELSE
        raise exception 'incorrect event date';
    END IF;
END;
 $$ LANGUAGE PLPGSQL;

CREATE TRIGGER check_event_date_trigger
BEFORE INSERT
ON event
FOR EACH ROW
EXECUTE PROCEDURE test_event_date();