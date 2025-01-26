<?php

readonly class ChristmasTree
{
    public function __construct(private int $cols, private int $rows)
    {
    }

    public function draw(): void
    {
        echo sprintf("%s⭐️%s\n", $this->randomSnow(), $this->randomSnow());

        for ($i = 1; $i <= $this->rows; $i++) {
            $this->printLine($i);

            if (0 === $i % 3) {
                $this->printLine($i - 1);
            }
        }
    }

    private function printLine(int $i): void
    {
        echo sprintf(
            "%s%s🟤%s%s\n",
            $this->randomSnow($i),
            $this->randomGarland($i),
            $this->randomGarland($i),
            $this->randomSnow($i),
        );
    }

    private function randomGarland(int $count): string
    {
        $garland = array_merge(
            str_split(str_repeat("🟢", 20), 4),
            ["🔴", "🟡", "🔵", "🟣"],
        );

        for ($i = 0; $i < $count; $i++) {
            $ledge[] = $garland[rand(0, count($garland)-1)];
        }

        return implode('', $ledge ?: []);
    }

    private function randomSnow(int $garlandCount = 0): string
    {
        $cols = $this->cols / 2;
        if (0 !== $cols % 10) {
            $cols -= $cols % 10;
        }

        $snowflakes = $cols - $garlandCount;
        $spaces = $this->rows;

        $line = [];
        for ($i = 0; $i < $snowflakes - $spaces; $i++) {
            $line[] = "❄️";
        }

        for ($i = 0; $i < $spaces; $i++) {
            $line[] = "  ";
        }

        shuffle($line);

        return implode('', $line);
    }
}
