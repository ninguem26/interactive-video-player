INSERT INTO videos (title,  url, format, duration, created_at, updated_at) VALUES (
    'Vídeo da Dora',
    'media/dora.mp4',
    'mp4',
    5,
    NOW(),
    NOW()
);

INSERT INTO videos (title, url, format, duration, created_at, updated_at) VALUES (
    'Myron Cozinhando',
    'media/miro cozinheiro.mp4',
    'mp4',
    12,
    NOW(),
    NOW()
);

INSERT INTO videos (title, url, format, duration, created_at, updated_at) VALUES (
    'Brooklyn 99 - Episódio 10',
    'media/b99.mkv',
    'mkv',
    1301,
    NOW(),
    NOW()
);

INSERT INTO videos (title, url, format, duration, created_at, updated_at) VALUES (
    'COS-UFAL',
    'media/timeskip.mp4',
    'mp4',
    33,
    NOW(),
    NOW()
);


INSERT INTO video_contents (video_id, type, options, created_at, updated_at) VALUES (
    1,
    'problem',
    '[{"time": 3}]',
    NOW(),
    NOW()
);

INSERT INTO video_problems (video_content_id, question, alternatives, answers, created_at, updated_at) VALUES (
    1,
    'Qual o nome dessa gata',
    '[{"1": "Dara", "2": "Dera", "3": "Dira", "4": "Dora"}]',
    '[{"answer": 4}]',
    NOW(),
    NOW()
);
