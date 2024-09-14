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

	public function setStatus(int $status): self
	{
		$this->status = $status;
		return $this;
	}

	public function headers(): array
	{
		return $this->headers;
	}

	public function setHeader(string $header, string $value): self
	{
		$this->headers[strtolower($header)] = $value;
		return $this;
	}

	public function removeHeader(string $header): void
	{
		unset($this->headers[strtolower($header)]);
	}

	public function content(): ?string
	{
		return $this->content;
	}

	public function setContent(?string $content): self
	{
		$this->content = $content;
		return $this;
	}

	public function sendContentType(string $content) : self
	{
		$this->setHeader('Content-Type', $content);
		return $this;	}

	public function prepare(): void
	{
		if (is_null($this->content)) {
			$this->removeHeader('Content-Type');
		} else {
			$this->setHeader('Content-Length', strlen($this->content));
		}
	}

	public static function json(array $data) : self
	{
		return (new self())
			->sendContentType('application/json')
			->setContent(json_encode($data));
	}

	public static function html(string $html) : self
	{
		return (new self())
			->sendContentType('text/html')
			->setContent($html);
	}

	public static function text(string $text) : self
	{
		return (new self())
			->sendContentType('text/plain')
			->setContent($text);
	}

	public static function redirect(string $url): self
	{
		return (new self())
			->setStatus(302)
			->setHeader("Location", $url);
	}
}