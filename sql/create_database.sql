DROP TABLE IF EXISTS public.contact CASCADE;
CREATE TABLE public.contact (
    id SERIAL PRIMARY KEY,
    name character varying(255) NOT NULL,
    firstname character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone character varying(255) DEFAULT NULL::character varying
);

DROP TABLE IF EXISTS public.event CASCADE;
CREATE TABLE public.event (
    id SERIAL PRIMARY KEY,
    label character varying(255) NOT NULL,
    description text NOT NULL,
    date_publication date NOT NULL,
    place character varying(255) NOT NULL,
    type_event character varying(255) NOT NULL,
    date date NOT NULL,
    author_id integer
);

DROP TABLE IF EXISTS public.guest CASCADE;
CREATE TABLE public.guest (
    id SERIAL PRIMARY KEY,
    name character varying(255) NOT NULL,
    firstname character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone character varying(255) DEFAULT NULL::character varying,
    password character varying(255) NOT NULL,
    is_confirmed boolean NOT NULL
);

DROP TABLE IF EXISTS public.migration_versions CASCADE;
CREATE TABLE public.migration_versions (
    version character varying(14) NOT NULL,
    executed_at timestamp(0) without time zone NOT NULL
);

COMMENT ON COLUMN public.migration_versions.executed_at IS '(DC2Type:datetime_immutable)';

DROP TABLE IF EXISTS public.news CASCADE;
CREATE TABLE public.news (
    id SERIAL PRIMARY KEY,
    label character varying(255) NOT NULL,
    description text NOT NULL,
    date_publication date NOT NULL,
    date date NOT NULL,
    image character varying(255) NOT NULL,
    author_id integer
);

DROP TABLE IF EXISTS public.participation CASCADE;
CREATE TABLE public.participation (
    id SERIAL PRIMARY KEY,
    guest_id integer,
    event_id integer,
    nb_persons integer,
    participe boolean NOT NULL
);

DROP TABLE IF EXISTS public.project CASCADE;
CREATE TABLE public.project (
    id SERIAL PRIMARY KEY,
    label character varying(255) NOT NULL,
    description text NOT NULL,
    date_publication date NOT NULL,
    date date NOT NULL,
    image character varying(255) NOT NULL,
    date_end date NOT NULL
);

DROP TABLE IF EXISTS public.project_guest CASCADE;
CREATE TABLE public.project_guest (
    project_id SERIAL PRIMARY KEY,
    guest_id integer NOT NULL
);

ALTER TABLE ONLY public.migration_versions ADD CONSTRAINT migration_versions_pkey PRIMARY KEY (version);

ALTER TABLE public.contact OWNER TO postgres;
ALTER TABLE public.event OWNER TO postgres;
ALTER TABLE public.guest OWNER TO postgres;
ALTER TABLE public.news OWNER TO postgres;
ALTER TABLE public.migration_versions OWNER TO postgres;
ALTER TABLE public.participation OWNER TO postgres;
ALTER TABLE public.project OWNER TO postgres;
ALTER TABLE public.project_guest OWNER TO postgres;

ALTER TABLE ONLY public.news ADD CONSTRAINT fk_news_guest FOREIGN KEY (author_id) REFERENCES public.guest(id);
ALTER TABLE ONLY public.event ADD CONSTRAINT fk_event_guest FOREIGN KEY (author_id) REFERENCES public.guest(id);
ALTER TABLE ONLY public.participation ADD CONSTRAINT fk_participation_event FOREIGN KEY (event_id) REFERENCES public.event(id);
ALTER TABLE ONLY public.participation ADD CONSTRAINT fk_participation_guest FOREIGN KEY (guest_id) REFERENCES public.guest(id);
ALTER TABLE ONLY public.project_guest ADD CONSTRAINT fk_project_guest_project FOREIGN KEY (project_id) REFERENCES public.project(id) ON DELETE CASCADE;
ALTER TABLE ONLY public.project_guest ADD CONSTRAINT fk_project_guest_guest FOREIGN KEY (guest_id) REFERENCES public.guest(id) ON DELETE CASCADE;