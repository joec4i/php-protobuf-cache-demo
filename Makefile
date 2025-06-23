PROTOC_GEN_PHP_OUT=src/Proto

.PHONY: proto
proto:
	docker-compose run --rm php protoc \
		--proto_path=proto/v1 --php_out=$(PROTOC_GEN_PHP_OUT)/V1 proto/v1/test.proto
	docker-compose run --rm php protoc \
		--proto_path=proto/v2 --php_out=$(PROTOC_GEN_PHP_OUT)/V2 proto/v2/test.proto

