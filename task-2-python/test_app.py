from app import sum


def test_sum_integers():
    assert sum(1, 2) == 3


def test_sum_decimals():
    assert sum(1.5, 2.3) == 3.8
