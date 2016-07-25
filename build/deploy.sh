#!/bin/bash
BUILD_ROOT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
ROOT_DIR=$(dirname "${BUILD_ROOT_DIR}")
PROJECTS_DIR=$(dirname "${ROOT_DIR}")

cp $PROJECTS_DIR/local.xml $ROOT_DIR/app/etc