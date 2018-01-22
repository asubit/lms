#!/usr/bin/env groovy
pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building'
                echo 'Git checkout...'
		checkout changelog: false, poll: false, scm: [$class: 'GitSCM', branches: [[name: '*/master']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[credentialsId: 'github', url: 'https://github.com/asubit/lms']]]
		echo 'Git checkout COMPLETE'
	    }
        }
        stage('Test') {
            steps {
                echo 'Testing..'
            }
        }
        stage('Deploy') {
            steps {
                echo 'Deploying....'
		sh 'cd /var/www/lms'
		sh 'php app/console cache:clear --env=dev'
		sh 'php app/console cache:clear --env=prod'
            }
        }
    }
}
