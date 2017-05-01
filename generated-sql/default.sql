
BEGIN;

-----------------------------------------------------------------------
-- ticusers
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "ticusers" CASCADE;

CREATE TABLE "ticusers"
(
    "id" serial NOT NULL,
    "email" VARCHAR(50) NOT NULL,
    "password" VARCHAR(257) NOT NULL,
    "firstname" VARCHAR(50) NOT NULL,
    "lastname" VARCHAR(50) NOT NULL,
    "permission" INTEGER NOT NULL,
    PRIMARY KEY ("id")
);

-----------------------------------------------------------------------
-- leaderboard
-----------------------------------------------------------------------

DROP TABLE IF EXISTS "leaderboard" CASCADE;

CREATE TABLE "leaderboard"
(
    "id" serial NOT NULL,
    "points" INTEGER NOT NULL,
    "win" INTEGER NOT NULL,
    "draw" INTEGER NOT NULL,
    "lose" INTEGER NOT NULL,
    "userid" INTEGER NOT NULL,
    PRIMARY KEY ("id")
);

COMMIT;
