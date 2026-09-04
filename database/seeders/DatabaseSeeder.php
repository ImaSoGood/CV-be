<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем страницы
        $pageIds = $this->createPages();
        
        // Создаем контент для страниц
        $this->createContent($pageIds);
        
        // Создаем общие настройки
        $this->createGeneralSettings();
    }

    private function createPages(): array
    {
        $pages = [
            [
                'visibility' => true,
                'meta_data' => json_encode([
                    'title' => 'Experience',
                    'slug' => 'experience',
                    'description' => 'Мой профессиональный опыт',
                    'keywords' => 'опыт, разработка, программирование',
                ]),
                'data' => json_encode([
                    'template' => 'experience',
                    'layout' => 'default',
                    'show_in_menu' => true,
                    'menu_order' => 1,
                ]),
            ],
            [
                'visibility' => true,
                'meta_data' => json_encode([
                    'title' => 'Work',
                    'slug' => 'work',
                    'description' => 'Мои проекты и работы',
                    'keywords' => 'проекты, работы, портфолио',
                ]),
                'data' => json_encode([
                    'template' => 'work',
                    'layout' => 'default',
                    'show_in_menu' => true,
                    'menu_order' => 2,
                ]),
            ],
            [
                'visibility' => true,
                'meta_data' => json_encode([
                    'title' => 'Future',
                    'slug' => 'future',
                    'description' => 'Мои планы и цели',
                    'keywords' => 'планы, цели, развитие',
                ]),
                'data' => json_encode([
                    'template' => 'future',
                    'layout' => 'default',
                    'show_in_menu' => true,
                    'menu_order' => 3,
                ]),
            ],
            [
                'visibility' => true,
                'meta_data' => json_encode([
                    'title' => 'Contacts',
                    'slug' => 'contacts',
                    'description' => 'Свяжитесь со мной',
                    'keywords' => 'контакты, связь, email',
                ]),
                'data' => json_encode([
                    'template' => 'contacts',
                    'layout' => 'default',
                    'show_in_menu' => true,
                    'menu_order' => 4,
                ]),
            ],
            [
                'visibility' => false,
                'meta_data' => json_encode([
                    'title' => 'CV',
                    'slug' => 'cv',
                    'description' => 'Мое резюме',
                ]),
                'data' => json_encode([
                    'template' => 'cv',
                    'layout' => 'default',
                    'show_in_menu' => true,
                    'menu_order' => 5,
                ]),
            ],
        ];

        $ids = [];
        foreach ($pages as $page) {
            $page['created_at'] = now();
            $page['updated_at'] = now();
            $id = DB::table('pages')->insertGetId($page);
            $ids[json_decode($page['data'])->template] = $id;
        }

        return $ids;
    }

    private function createContent(array $pageIds): void
    {
        $content = [
            // ==================== СТРАНИЦА EXPERIENCE ====================
            
            // 1. Hero блок
            [
                'page_id' => $pageIds['experience'],
                'position' => 1,
                'type' => 'hero',
                'meta_data' => json_encode([
                    'size' => 'large',
                    'alignment' => 'center',
                    'background' => 'gradient',
                    'animation' => 'fade-in',
                ]),
                'header' => 'Мой профессиональный опыт',
                'aditional' => 'Software Engineer',
                'text' => 'Я разработчик с более чем <b>5-летним</b> опытом создания веб-приложений и сервисов. Специализируюсь на <b>Laravel</b>, <b>Vue.js</b> и современных технологиях разработки.',
                'content_data' => null,
            ],

            // 2. Разделитель
            [
                'page_id' => $pageIds['experience'],
                'position' => 2,
                'type' => 'divider',
                'meta_data' => json_encode([
                    'style' => 'solid',
                    'color' => '#e5e7eb',
                    'width' => '100%',
                    'thickness' => 2,
                    'margin' => '40px 0',
                ]),
                'header' => null,
                'aditional' => null,
                'text' => null,
                'content_data' => null,
            ],

            // 3. Два столбца с информацией
            [
                'page_id' => $pageIds['experience'],
                'position' => 3,
                'type' => 'columns',
                'meta_data' => json_encode([
                    'columns' => 2,
                    'gap' => '40px',
                    'alignment' => 'top',
                ]),
                'header' => 'Ключевые навыки',
                'aditional' => 'Технологический стек',
                'text' => null,
                'content_data' => json_encode([
                    'columns' => [
                        [
                            'title' => 'Backend',
                            'text' => '<b>PHP</b> (Laravel, Symfony)<br><b>Python</b> (Django)<br><b>Node.js</b><br><b>PostgreSQL</b>, MySQL, MongoDB',
                            'button' => null,
                        ],
                        [
                            'title' => 'Frontend',
                            'text' => '<b>Vue.js</b> (Nuxt)<br><b>React</b> (Next.js)<br><b>Tailwind CSS</b><br><b>TypeScript</b>, JavaScript',
                            'button' => [
                                'text' => 'Подробнее о навыках',
                                'url' => '/skills',
                                'style' => 'primary',
                            ],
                        ],
                    ],
                ]),
            ],

            // 4. Timeline (опыт работы)
            [
                'page_id' => $pageIds['experience'],
                'position' => 4,
                'type' => 'timeline',
                'meta_data' => json_encode([
                    'orientation' => 'vertical',
                    'animation' => 'slide',
                ]),
                'header' => 'Опыт работы',
                'aditional' => 'Ключевые проекты и достижения',
                'text' => null,
                'content_data' => json_encode([
                    'items' => [
                        [
                            'year' => '2023-2024',
                            'title' => 'Senior Developer',
                            'subtitle' => 'Компания А',
                            'description' => 'Разработка высоконагруженных систем с использованием <b>Laravel</b> и <b>Vue.js</b>. Внедрение <b>Redis</b> для кеширования.',
                            'tags' => ['PHP', 'Vue.js', 'Redis', 'Docker'],
                            'icon' => 'star',
                        ],
                        [
                            'year' => '2021-2023',
                            'title' => 'Full-stack Developer',
                            'subtitle' => 'Компания Б',
                            'description' => 'Создание CRM систем для крупных предприятий. Разработка <b>REST API</b> и интеграция с внешними сервисами.',
                            'tags' => ['React', 'Node.js', 'PostgreSQL', 'AWS'],
                            'icon' => 'code',
                        ],
                        [
                            'year' => '2019-2021',
                            'title' => 'Junior Developer',
                            'subtitle' => 'Компания В',
                            'description' => 'Веб-разработка на <b>PHP</b> и <b>JavaScript</b>. Работа в команде над коммерческими проектами.',
                            'tags' => ['PHP', 'JavaScript', 'MySQL', 'HTML/CSS'],
                            'icon' => 'rocket',
                        ],
                    ],
                ]),
            ],

            // 5. Список технологий (обведенный текст)
            [
                'page_id' => $pageIds['experience'],
                'position' => 5,
                'type' => 'tags',
                'meta_data' => json_encode([
                    'style' => 'rounded',
                    'size' => 'medium',
                    'color' => 'blue',
                ]),
                'header' => 'Технологии',
                'aditional' => 'С которыми работаю',
                'text' => null,
                'content_data' => json_encode([
                    'items' => [
                        'PHP', 'Laravel', 'Vue.js', 'React', 'TypeScript',
                        'Node.js', 'Python', 'Docker', 'Kubernetes', 'AWS',
                        'PostgreSQL', 'MySQL', 'MongoDB', 'Redis', 'Elasticsearch',
                        'Git', 'Linux', 'Nginx', 'Apache',
                    ],
                ]),
            ],

            // ==================== СТРАНИЦА WORK ====================

            // 6. Hero для Work
            [
                'page_id' => $pageIds['work'],
                'position' => 1,
                'type' => 'hero',
                'meta_data' => json_encode([
                    'size' => 'medium',
                    'alignment' => 'left',
                    'background' => 'light',
                ]),
                'header' => 'Мои работы',
                'aditional' => 'Портфолио проектов',
                'text' => 'Здесь представлены мои лучшие проекты, над которыми я работал в последнее время.',
                'content_data' => null,
            ],

            // 7. Grid с проектами
            [
                'page_id' => $pageIds['work'],
                'position' => 2,
                'type' => 'grid',
                'meta_data' => json_encode([
                    'columns' => 3,
                    'gap' => '30px',
                    'layout' => 'cards',
                ]),
                'header' => 'Проекты',
                'aditional' => 'Реализованные решения',
                'text' => null,
                'content_data' => json_encode([
                    'items' => [
                        [
                            'title' => 'Task Manager',
                            'description' => 'Веб-приложение для управления задачами с <b>Kanban</b> доской',
                            'tech' => ['Laravel', 'Vue.js', 'MySQL'],
                            'link' => '/project/task-manager',
                            'image' => '/images/projects/task-manager.jpg',
                            'status' => 'completed',
                            'github' => 'https://github.com/username/task-manager',
                        ],
                        [
                            'title' => 'E-commerce Platform',
                            'description' => 'Интернет-магазин с <b>AI</b> рекомендациями',
                            'tech' => ['React', 'Node.js', 'PostgreSQL'],
                            'link' => '/project/ecommerce',
                            'image' => '/images/projects/ecommerce.jpg',
                            'status' => 'in-progress',
                            'github' => 'https://github.com/username/ecommerce',
                        ],
                        [
                            'title' => 'Mobile App',
                            'description' => 'Кроссплатформенное мобильное приложение',
                            'tech' => ['Flutter', 'Firebase'],
                            'link' => '/project/mobile-app',
                            'image' => '/images/projects/mobile-app.jpg',
                            'status' => 'completed',
                            'github' => 'https://github.com/username/mobile-app',
                        ],
                    ],
                ]),
            ],

            // ==================== СТРАНИЦА FUTURE ====================

            // 8. Hero для Future
            [
                'page_id' => $pageIds['future'],
                'position' => 1,
                'type' => 'hero',
                'meta_data' => json_encode([
                    'size' => 'medium',
                    'alignment' => 'center',
                ]),
                'header' => 'Мои цели и планы',
                'aditional' => 'Куда я двигаюсь',
                'text' => 'Я постоянно развиваюсь и стремлюсь к новым вершинам в своей профессиональной деятельности.',
                'content_data' => null,
            ],

            // 9. Goals с прогрессом
            [
                'page_id' => $pageIds['future'],
                'position' => 2,
                'type' => 'goals',
                'meta_data' => json_encode([
                    'show_progress' => true,
                    'layout' => 'cards',
                ]),
                'header' => 'Планы развития',
                'aditional' => 'Ближайшие цели',
                'text' => null,
                'content_data' => json_encode([
                    'items' => [
                        [
                            'title' => 'Изучение AI/ML',
                            'description' => 'Планирую углубиться в <b>машинное обучение</b> и нейронные сети',
                            'progress' => 30,
                            'status' => 'in-progress',
                            'deadline' => '2025',
                        ],
                        [
                            'title' => 'Создание стартапа',
                            'description' => 'Работа над собственным <b>SaaS</b> продуктом',
                            'progress' => 60,
                            'status' => 'in-progress',
                            'deadline' => '2024',
                        ],
                        [
                            'title' => 'Международный опыт',
                            'description' => 'Работа в <b>международной компании</b> или переезд',
                            'progress' => 20,
                            'status' => 'planned',
                            'deadline' => '2026',
                        ],
                    ],
                ]),
            ],

            // 10. Кнопки с призывом
            [
                'page_id' => $pageIds['future'],
                'position' => 3,
                'type' => 'buttons',
                'meta_data' => json_encode([
                    'alignment' => 'center',
                    'spacing' => '20px',
                ]),
                'header' => 'Готов к сотрудничеству',
                'aditional' => 'Открыт для предложений',
                'text' => null,
                'content_data' => json_encode([
                    'buttons' => [
                        [
                            'text' => 'Связаться со мной',
                            'url' => '/contacts',
                            'style' => 'primary',
                            'size' => 'large',
                        ],
                        [
                            'text' => 'Посмотреть резюме',
                            'url' => '/cv',
                            'style' => 'secondary',
                            'size' => 'large',
                        ],
                        [
                            'text' => 'GitHub',
                            'url' => 'https://github.com/username',
                            'style' => 'outline',
                            'size' => 'medium',
                            'icon' => 'github',
                        ],
                    ],
                ]),
            ],

            // ==================== СТРАНИЦА CONTACTS ====================

            // 11. Контакты с формой
            [
                'page_id' => $pageIds['contacts'],
                'position' => 1,
                'type' => 'contacts',
                'meta_data' => json_encode([
                    'show_form' => true,
                    'show_social' => true,
                    'layout' => 'two-columns',
                ]),
                'header' => 'Связь со мной',
                'aditional' => 'Буду рад новым знакомствам',
                'text' => '<b>Email:</b> <a href="mailto:test@example.com">test@example.com</a><br>
                           <b>Телефон:</b> <a href="tel:+79991234567">+7 (999) 123-45-67</a><br>
                           <b>Telegram:</b> <a href="https://t.me/username">@username</a>',
                'content_data' => json_encode([
                    'info' => [
                        'email' => 'test@example.com',
                        'phone' => '+7 (999) 123-45-67',
                        'telegram' => '@username',
                        'location' => 'Москва, Россия',
                    ],
                    'social' => [
                        [
                            'name' => 'GitHub',
                            'url' => 'https://github.com/username',
                            'icon' => 'github',
                            'color' => '#333',
                        ],
                        [
                            'name' => 'LinkedIn',
                            'url' => 'https://linkedin.com/in/username',
                            'icon' => 'linkedin',
                            'color' => '#0A66C2',
                        ],
                        [
                            'name' => 'Twitter',
                            'url' => 'https://twitter.com/username',
                            'icon' => 'twitter',
                            'color' => '#1DA1F2',
                        ],
                        [
                            'name' => 'YouTube',
                            'url' => 'https://youtube.com/username',
                            'icon' => 'youtube',
                            'color' => '#FF0000',
                        ],
                    ],
                ]),
            ],
        ];

        foreach ($content as $item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            DB::table('content')->insert($item);
        }
    }

    private function createGeneralSettings(): void
    {
        DB::table('general')->insert([
            'meta_data' => json_encode([
                'site_name' => 'Vvvv Kkkk',
                'site_description' => 'Личный сайт-портфолио разработчика',
                'author' => 'Vvvv Kkkk',
            ]),
            'sections' => json_encode([
                'header' => [
                    'enable' => true,
                    'logo' => [
                        'text' => 'Vvvv Kkkk',
                        'subtitle' => 'Software Engineer',
                    ],
                    'menu' => [
                        ['position' => 1, 'text' => 'Experience', 'redirect' => '/experience'],
                        ['position' => 2, 'text' => 'Work', 'redirect' => '/work'],
                        ['position' => 3, 'text' => 'Future', 'redirect' => '/future'],
                        ['position' => 4, 'text' => 'CV', 'redirect' => '/cv'],
                    ],
                ],
                'footer' => [
                    'enable' => true,
                    'columns' => [
                        [
                            'position' => 1,
                            'title' => 'Vvvv Kkkk',
                            'subtitle' => 'Software Engineer',
                        ],
                        [
                            'position' => 2,
                            'title' => 'Работа',
                            'items' => [
                                ['title' => 'Опыт', 'url' => '/experience'],
                                ['title' => 'Проекты', 'url' => '/work'],
                                ['title' => 'Резюме', 'url' => '/cv'],
                            ],
                        ],
                        [
                            'position' => 3,
                            'title' => 'Связь',
                            'items' => [
                                ['title' => 'Email', 'url' => 'mailto:test@example.com'],
                                ['title' => 'GitHub', 'url' => 'https://github.com/username'],
                                ['title' => 'Telegram', 'url' => 'https://t.me/username'],
                            ],
                        ],
                    ],
                ],
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}