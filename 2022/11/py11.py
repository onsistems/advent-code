# https://adventofcode.com/2022/day/11

# given the inputs, creates the evaluation function we need
def create_func(value, modify):
    assert modify in ['+','*']
    if value == 'old':
        return (lambda x: x + x) if modify == '+' else (lambda x: x * x)
    else:
        return (lambda x: x + int(value)) if modify == '+' else (lambda x: x * int(value))

# translate input into the functions & values we need
def get_monkey_facts(row):
    input = row.split('\n') # split by row
    m_id = int(input[0].split(':')[0]) # we know first row has monkey id 

    # we know second row has starting items
    items = [int(i) for i in input[1].split(': ')[1].split(', ')] 
    
    # third row details the evaluation function 
    value = input[2].split(' ')[-1]
    modify = input[2].split(' ')[-2]
    func = create_func(value, modify)

    # last rows detail the test function
    divval = int(input[3].split(' ')[-1])
    if_true = int(input[4].split(' ')[-1])
    if_false = int(input[5].split(' ')[-1])
    test = lambda x: if_true if (x%divval) == 0 else if_false

    # output key results
    return {'id': m_id, 'items': items, 'func': func, 'test': test}

# apply one of these functions after every modification
def reduce_worry1(x): # part 1
    return int(x/3)
def reduce_worry2(x): # part 2 
    return x % 9699690 
# this is the lowest common multiple of the numbers used in the test functions
# i.e. lowest_common_multiple(3, 13, 19, 17, 5, 7, 11, 2) = 9699690
# we can remove this value safely without affecting future calculations

# main solver function
def solver(parsed_data, worry_func, n_rounds):

    # here's what we need for the computations
    monkey_items = {X['id']:X['items'] for X in parsed_data}
    monkey_funcs = {X['id']:X['func'] for X in parsed_data}
    monkey_tests = {X['id']:X['test'] for X in parsed_data}
    monkey_count = {X['id']: 0 for X in parsed_data}

    for _ in range(n_rounds): # we do 20 round
        # in a round we go through all items
        for monkey, old_worries in monkey_items.items():
            new_worries = [monkey_funcs[monkey](i) for i in old_worries] # apply func
            new_worries = [worry_func(i) for i in new_worries] # div by 3
            send_to = [monkey_tests[monkey](i) for i in new_worries] # apply test 
            [monkey_items[to].append(worry) for to, worry in zip(send_to, new_worries)] # send on
            monkey_items[monkey] = [] # reset this monkey's list
            monkey_count[monkey] += len(old_worries) # increment counter

    # count up the number of events
    counters = list(monkey_count.values())
    counters.sort() # get the 2 largest
    x,y = counters[-2:]
    return x*y

# read and process data
with open('input.txt','r') as f:
    data = f.read()
rows = [row for row in data.strip().split('Monkey ') if len(row)>0]
# clean and parse things
parsed_data = [get_monkey_facts(row) for row in rows]

# answer to part 1
print(solver(parsed_data, reduce_worry1, 20))
# answer to part 2
print(solver(parsed_data, reduce_worry2, 10000))