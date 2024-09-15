<?php

namespace Knight\Http;

class Response
{
    /**
     * @var int The HTTP status code of the response.
     */
    protected int $status = 200;

    /**
     * @var array The headers of the response.
     */
    protected array $headers = [];

    /**
     * @var ?string The content of the response.
     */
    protected ?string $content = null;

    /**
     * Get the HTTP status code of the response.
     *
     * @return int The HTTP status code.
     */
    public function status(): int
    {
        return $this->status;
    }

    /**
     * Set the HTTP status code of the response.
     *
     * @param int $status The HTTP status code.
     * @return self The current instance for method chaining.
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get the headers of the response.
     *
     * @return array The headers of the response.
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * Set a header for the response.
     *
     * @param string $header The name of the header.
     * @param string $value The value of the header.
     * @return self The current instance for method chaining.
     */
    public function setHeader(string $header, string $value): self
    {
        $this->headers[strtolower($header)] = $value;
        return $this;
    }

    /**
     * Remove a header from the response.
     *
     * @param string $header The name of the header to remove.
     */
    public function removeHeader(string $header): void
    {
        unset($this->headers[strtolower($header)]);
    }

    /**
     * Get the content of the response.
     *
     * @return ?string The content of the response.
     */
    public function content(): ?string
    {
        return $this->content;
    }

    /**
     * Set the content of the response.
     *
     * @param ?string $content The content of the response.
     * @return self The current instance for method chaining.
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Set the Content-Type header of the response.
     *
     * @param string $content The content type.
     * @return self The current instance for method chaining.
     */
    public function sendContentType(string $content): self
    {
        $this->setHeader('Content-Type', $content);
        return $this;
    }

    /**
     * Prepare the response by setting the Content-Length header if content is present.
     */
    public function prepare(): void
    {
        if (is_null($this->content)) {
            $this->removeHeader('Content-Type');
        } else {
            $this->setHeader('Content-Length', strlen($this->content));
        }
    }

    /**
     * Create a JSON response.
     *
     * @param array $data The data to encode as JSON.
     * @return self A new Response instance with JSON content.
     */
    public static function json(array $data): self
    {
        return (new self())
            ->sendContentType('application/json')
            ->setContent(json_encode($data));
    }

    /**
     * Create an HTML response.
     *
     * @param string $html The HTML content.
     * @return self A new Response instance with HTML content.
     */
    public static function html(string $html): self
    {
        return (new self())
            ->sendContentType('text/html')
            ->setContent($html);
    }

    /**
     * Create a plain text response.
     *
     * @param string $text The plain text content.
     * @return self A new Response instance with plain text content.
     */
    public static function text(string $text): self
    {
        return (new self())
            ->sendContentType('text/plain')
            ->setContent($text);
    }

    /**
     * Create a redirect response.
     *
     * @param string $url The URL to redirect to.
     * @return self A new Response instance with a 302 status and Location header.
     */
    public static function redirect(string $url): self
    {
        return (new self())
            ->setStatus(302)
            ->setHeader("Location", $url);
    }
}