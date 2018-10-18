pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                sh 'echo "Getting started!"'
                checkout scm
                script {
                    if (fileExists('composer.phar')) {
                        echo 'composer found'
                    } else {
                        sh 'php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"'
                        sh 'php composer-setup.php'
                        sh 'php -r "unlink(\'composer-setup.php\');"'
                        sh 'cp composer.phar composer.phar'
                    }
                }
                sh './composer.phar self-update'
            }
        }
        stage('install') {
            steps {
                sh './composer.phar install'
            }
        }
        stage('test') {
            steps {
                sh './vendor/bin/phpunit'
            }
        }
    }
}