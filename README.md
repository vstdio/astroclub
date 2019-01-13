# Build

docker build --tag=astroclub .

# Run

docker run -p "8080:8080" -v ${PWD}/app:/app -t astroclub