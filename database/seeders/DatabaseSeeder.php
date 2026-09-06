<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $resumes = [
    [
        'position' => 'Senior PHP Developer',
        'company' => 'IT Solutions LLC',
        'description' => 'Разработка высоконагруженных веб-сервисов. Управление командой из 5 разработчиков.',
        'started_at' => '2020-01-01',
        'ended_at' => '2022-12-31',
    ],
    [
        'position' => 'Full Stack Developer',
        'company' => 'WebStudio Pro',
        'description' => 'Создание SPA приложений на Vue.js + Laravel. Внедрение CI/CD.',
        'started_at' => '2018-06-01',
        'ended_at' => '2020-12-31',
    ],
    [
        'position' => 'Backend Developer',
        'company' => 'FinTech Systems',
        'description' => 'Разработка микросервисной архитектуры для банковского ПО.',
        'started_at' => '2016-03-01',
        'ended_at' => '2018-05-31',
    ],
    [
        'position' => 'DevOps Engineer',
        'company' => 'Cloud Services Inc',
        'description' => 'Настройка инфраструктуры AWS, Docker, Kubernetes.',
        'started_at' => '2021-01-01',
        'ended_at' => null, 
    ],
    [
        'position' => 'Team Lead',
        'company' => 'GameDev Studio',
        'description' => 'Руководство отделом разработки игровых серверов.',
        'started_at' => '2019-07-01',
        'ended_at' => '2021-12-31',
    ],
        ];

        $works = [
            0 => [
                'Рефакторинг легаси кода с повышением производительности на 40%',
                'Разработка REST API для мобильного приложения с 1M+ пользователей',
                'Внедрение кеширования Redis и оптимизация запросов',
                'Настройка мониторинга и логирования (ELK stack)',
            ],
            1 => [
                'Создание админ-панели с динамическими дашбордами',
                'Разработка системы уведомлений (WebSockets)',
                'Интеграция с платежными системами Stripe, PayPal',
                'Настройка Docker окружения для разработки',
            ],
            2 => [
                'Проектирование базы данных для финансовых транзакций',
                'Реализация очередей задач на RabbitMQ',
                'Разработка системы кэширования для API банка',
                'Миграция с монолита на микросервисы',
            ],
            3 => [
                'Настройка кластеров Kubernetes (EKS)',
                'Автоматизация деплоя через GitHub Actions',
                'Настройка VPC, Security Groups, IAM',
                'Внедрение системы бэкапов и DRP',
            ],
            4 => [
                'Управление командой из 12 разработчиков',
                'Внедрение Agile/Scrum процессов',
                'Проведение код-ревью и менторство',
                'Оптимизация серверной инфраструктуры',
            ],
        ];

        foreach ($resumes as $index => $resumeData) {
            $resumeId = DB::table('resumes')->insertGetId([
                'position' => $resumeData['position'],
                'company' => $resumeData['company'],
                'started_at' => $resumeData['started_at'],
                'ended_at' => $resumeData['ended_at'],
                'description' => $resumeData['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $workItems = $works[$index] ?? [];
            foreach ($workItems as $workText) {
                DB::table('resume_works')->insert([
                    'resume_id' => $resumeId,
                    'text' => $workText,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}