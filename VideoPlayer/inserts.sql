INSERT INTO videos (title,  url, format, duration, created_at, updated_at) VALUES (
    'Vídeo da Dora',
    'media/dora.mp4',
    'mp4',
    19,
    NOW(),
    NOW()
);

INSERT INTO videos (title, url, format, duration, created_at, updated_at) VALUES (
    'Steven Universe - Escapism',
    'media/Steven Universo - escapism.mp4',
    'mp4',
    670,
    NOW(),
    NOW()
);

INSERT INTO contents (videoId, type, options, created_at, updated_at) VALUES (
    2,
    'anotation',
    '{"data": "Essa é uma anotação", "time": 3, "duration": 3}',
    NOW(),
    NOW()
);
