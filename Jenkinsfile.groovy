pipeline {
    agent any
    stages {
        stage('Build') {
            steps {
                sh 'echo "Getting strated!"'
                checkout scm
            }
        }
        stage('test') {
            steps {
                sh 'composer install'
            }
        }
    }
}