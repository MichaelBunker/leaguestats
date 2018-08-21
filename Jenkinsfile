pipeline {
    agent { docker { image 'php' } }
    stages {
        stage('build') {
            steps {
                composer install
            }
        }
    }
}
