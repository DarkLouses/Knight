<?php

namespace Knight\Http;

class Response
{
	protected int $status = 200;
	protected array $headers = [];
	protected ?string $content = null;

	public function status(): int
	{
		return $this->status;
	}

	public function setStatus(int $status): void
	{
		$this->status = $status;
	}

	public function headers(): array
	{
		return $this->headers;
	}

	public function setHeader(string $header, string $value): string
	{
		return $this->headers[strtolower($header)] = $value;
	}

	public function removeHeader(string $header): void
	{
		unset($this->headers[strtolower($header)]);
	}

	public function content(): ?string
	{
		return $this->content;
	}

	public function setContent(?string $content): void
	{
		$this->content = $content;
	}

	public function prepare(): void
	{
		if (is_null($this->content)) {
			$this->removeHeader('Content-Type');
		} else {
			$this->setHeader('Content-Length', strlen($this->content));
		}
	}
}